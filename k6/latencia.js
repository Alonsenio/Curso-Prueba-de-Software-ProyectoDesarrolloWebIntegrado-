import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
  vus: 10,
  duration: '30s',
};

const productosMock = [
  {
    titulo: "Pelota de fútbol",
    cantidad: 2,
    imagen: "https://ejemplo.com/pelota.jpg",
    price: 60,
  },
  {
    titulo: "Camiseta deportiva",
    cantidad: 1,
    imagen: "https://ejemplo.com/camiseta.jpg",
    price: 80,
  },
];

export default function () {
  const payload = JSON.stringify({
    orderID: `ORDER-${Math.floor(Math.random() * 100000)}`,
    totalPagado: productosMock.reduce((acc, prod) => acc + prod.price * prod.cantidad, 0),
    productos: productosMock,
  });

  const headers = { 'Content-Type': 'application/json' };

  const res = http.post('http://web/procesarCompra.php', payload, { headers });

  check(res, {
    'status is 200': (r) => r.status === 200,
    'response includes success': (r) => r.body.includes('success'),
  });

  sleep(1);
}

export function handleSummary(data) {
  console.log('\n🕒 RESUMEN DE LA PRUEBA DE LATENCIA');
  console.log('-------------------------------------------');
  console.log(`👥 Usuarios virtuales: ${options.vus}`);
  console.log(`⏱ Duración total: ${options.duration}`);
  console.log(`📦 Solicitudes HTTP: ${data.metrics.http_reqs.values.count}`);
  console.log(`✔️ Solicitudes exitosas: ${(1 - data.metrics.http_req_failed.values.rate) * 100}%`);
  console.log(`🚀 Latencia promedio: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`⏳ Latencia máxima: ${Math.round(data.metrics.http_req_duration.values.max)} ms`);
  console.log(`⚡ Throughput: ${Math.round(data.metrics.http_reqs.values.rate)} req/seg`);
  console.log(`✅ Resultado general: ${data.metrics.http_req_failed.values.rate === 0 ? 'SIN ERRORES' : 'CON ERRORES'}\n`);
  return {};
}
