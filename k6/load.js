import http from 'k6/http';
import { sleep, check } from 'k6';
import { Trend } from 'k6/metrics';

let tiempoRespuesta = new Trend('tiempo_respuesta');

export let options = {
  stages: [
    { duration: '30s', target: 100 }, // Aumenta gradualmente a 100 VUs
    { duration: '30s', target: 100 }, // Mantiene 100 VUs por 30 segundos
    { duration: '10s', target: 0 },   // Finaliza la prueba
  ],
  thresholds: {
    http_req_failed: ['rate<0.01'],        // Menos del 1% de errores esperados
    http_req_duration: ['p(95)<1500'],     // El 95% debe responder en menos de 1.5s
  }
};

export default function () {
  const url = 'http://web/categorias.php';

  let res = http.get(url);

  check(res, {
    'status es 200': (r) => r.status === 200,
    'respuesta rápida': (r) => r.timings.duration < 1500
  });

  tiempoRespuesta.add(res.timings.duration);

  sleep(1); // Simula tiempo de navegación del usuario
}

export function handleSummary(data) {
  console.log('\n📊 RESUMEN DE LA PRUEBA DE CARGA');
  console.log('-------------------------------------------');
  console.log(`👥 Usuarios simulados: hasta 100`);
  console.log(`⏱ Duración total: 1 min`);
  console.log(`📦 Solicitudes HTTP: ${data.metrics.http_reqs.values.count}`);
  console.log(`✔️ Solicitudes exitosas: ${(1 - data.metrics.http_req_failed.values.rate) * 100}%`);
  console.log(`🚀 Promedio de respuesta: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`⏳ Máximo de respuesta: ${Math.round(data.metrics.http_req_duration.values.max)} ms`);
  console.log(`⚡ Throughput: ${Math.round(data.metrics.http_reqs.values.rate)} req/seg`);

  const errores = data.metrics.http_req_failed.values.rate;
  const latencia95 = data.metrics.http_req_duration.values['p(95)'];

  if (errores < 0.01 && latencia95 < 1500) {
    console.log('✅ Resultado general: PASÓ LA PRUEBA DE CARGA\n');
  } else {
    console.log('❌ Resultado general: FALLÓ LA PRUEBA DE CARGA\n');
  }

  return {};
}
