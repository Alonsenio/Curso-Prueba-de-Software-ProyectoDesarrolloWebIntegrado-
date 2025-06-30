import http from 'k6/http';
import { check, sleep } from 'k6';
import { Trend } from 'k6/metrics';

// Métrica personalizada para registrar tiempo de respuesta
let tiempoRespuesta = new Trend('tiempo_respuesta');

// Configuración de prueba
export let options = {
  vus: 50,                // 50 usuarios virtuales simultáneos
  duration: '30s',        // durante 30 segundos
  thresholds: {
    http_req_failed: ['rate==0'],         // No debe haber errores
    http_req_duration: ['p(95)<1000'],    // 95% de las respuestas < 1s
  },
};

export default function () {
  const res = http.get('http://web/categorias.php');
  tiempoRespuesta.add(res.timings.duration);

  // Validaciones para confirmar que la página carga correctamente
  check(res, {
    '✅ status es 200': (r) => r.status === 200,
    '📦 contiene productos': (r) => r.body.includes('Productos de'),
  });

  sleep(1); // Espera 1 segundo entre iteraciones
}

// Mostrar resumen por consola al finalizar
export function handleSummary(data) {
  console.log('\n📊 RESUMEN DE LA PRUEBA DE PERFORMANCE');
  console.log('-------------------------------------------');
  console.log(`👥 Usuarios virtuales (VUs): ${options.vus}`);
  console.log(`⏱ Duración total: ${options.duration}`);
  console.log(`📦 Solicitudes HTTP: ${data.metrics.http_reqs.values.count}`);
  console.log(`✔️ Solicitudes exitosas: ${(1 - data.metrics.http_req_failed.values.rate) * 100}%`);
  console.log(`🚀 Promedio de respuesta: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`⏳ Máximo: ${Math.round(data.metrics.http_req_duration.values.max)} ms`);
  console.log(`⚡ Throughput: ${Math.round(data.metrics.http_reqs.values.rate)} req/seg`);
  console.log('✅ Resultado general: SIN ERRORES (si los thresholds se cumplen)\n');

  return {};
}
