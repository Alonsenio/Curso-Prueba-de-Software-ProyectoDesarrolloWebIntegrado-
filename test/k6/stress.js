import http from 'k6/http';
import { check, sleep } from 'k6';
import { Trend } from 'k6/metrics';

let tiempoRespuesta = new Trend('tiempo_respuesta');

export let options = {
  vus: 0,
  stages: [
    { duration: '1m', target: 100 },   // subida gradual
    { duration: '1m', target: 300 },
    { duration: '1m', target: 500 },   // carga máxima
    { duration: '1m', target: 0 },     // desaceleración
  ],
  thresholds: {
    http_req_failed: ['rate<0.05'], // menos de 5% de fallas permitidas
    http_req_duration: ['p(95)<2000'], // 95% de respuestas bajo 2 segundos
  },
};

const urls = {
  login: 'http://web/Login/index.php',
  registrar: 'http://web/Login/index.php',
  compra: 'http://web/procesarCompra.php',
};

export default function () {
  let resLogin = http.post(urls.login, {
    user: 'usuario_test',
    pass: '123456',
  });
  tiempoRespuesta.add(resLogin.timings.duration);
  check(resLogin, {
    'Login OK': (r) => r.status === 200,
  });

  let resRegistro = http.post(urls.registrar, {
    registrar: '1',
    nombre: 'test stress',
    correo: `stress${__VU}${__ITER}@mail.com`,
    user: `stressUser${__VU}${__ITER}`,
    pass: '123456',
  });
  tiempoRespuesta.add(resRegistro.timings.duration);
  check(resRegistro, {
    'Registro OK': (r) => r.status === 200,
  });

  let resCompra = http.get(urls.compra);
  tiempoRespuesta.add(resCompra.timings.duration);
  check(resCompra, {
    'Compra cargó': (r) => r.status === 200,
  });

  sleep(1);
}

export function handleSummary(data) {
  console.log('\n📊 RESUMEN DE LA PRUEBA DE STRESS');
  console.log('-------------------------------------------');
  console.log(`⏱ Total de solicitudes: ${data.metrics.http_reqs.values.count}`);
  console.log(`📉 Fallas (%): ${(data.metrics.http_req_failed.values.rate * 100).toFixed(2)}%`);
  console.log(`🚀 Promedio de respuesta: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`⏳ Máximo de respuesta: ${Math.round(data.metrics.http_req_duration.values.max)} ms`);
  console.log(`⚡ Throughput: ${Math.round(data.metrics.http_reqs.values.rate)} req/seg`);

  const passed =
    data.metrics.http_req_failed.values.rate < 0.05 &&
    data.metrics.http_req_duration.values['p(95)'] < 2000;

  console.log(`✅ Resultado general: ${passed ? 'SIN ERRORES CRÍTICOS' : 'FALLÓ ALGÚN UMBRAL'}`);

  return {};
}
