import http from 'k6/http';
import { check } from 'k6';

export let options = {
  vus: 100, // Simula 100 usuarios simultáneos (hora punta)
  duration: '1m', // Carga sostenida durante 1 minuto
  thresholds: {
    http_req_failed: ['rate<0.01'], // Menos del 1% de errores
    http_req_duration: ['p(95)<500'], // 95% de las solicitudes deben responder en menos de 500ms
  },
};

export default function () {
  const payload = JSON.stringify({
    orderID: `TEST-${__VU}-${__ITER}`,
    totalPagado: 150.00,
    productos: [
      {
        titulo: "Pelota de fútbol",
        cantidad: 2,
        imagen: "https://via.placeholder.com/50",
        price: 75.00
      }
    ]
  });

  const headers = { 'Content-Type': 'application/json' };
  const res = http.post('http://web/procesarCompra.php', payload, { headers });

  check(res, {
    'status 200': (r) => r.status === 200,
  });
}

export function handleSummary(data) {
  console.log('\n📈 RESUMEN DE LA PRUEBA DE THROUGHPUT');
  console.log('-------------------------------------------');
  console.log(`👥 Usuarios virtuales: ${options.vus}`);
  console.log(`⏱ Duración total: ${options.duration}`);
  console.log(`📦 Solicitudes HTTP: ${data.metrics.http_reqs.values.count}`);
  console.log(`✔️ Solicitudes exitosas: ${(1 - data.metrics.http_req_failed.values.rate) * 100}%`);
  console.log(`🚀 Tiempo promedio de respuesta: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`⏳ Tiempo máximo: ${Math.round(data.metrics.http_req_duration.values.max)} ms`);
  console.log(`⚡ Throughput: ${Math.round(data.metrics.http_reqs.values.rate)} req/seg`);
  console.log(`✅ Resultado general: ${data.metrics.http_req_failed.values.rate === 0 ? 'SIN ERRORES' : 'CON ERRORES'}\n`);
  return {};
}
