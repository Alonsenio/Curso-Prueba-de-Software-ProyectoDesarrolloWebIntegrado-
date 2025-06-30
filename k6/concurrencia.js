import http from 'k6/http';
import { check, sleep } from 'k6';
import { Trend } from 'k6/metrics';

let tiempoRespuesta = new Trend('tiempo_respuesta_login');

export let options = {
  vus: 50,                // 50 usuarios simultáneos
  duration: '10s',        // durante 10 segundos
};

export default function () {
  const payload = {
    user: 'usuario_prueba',
    pass: 'contrasena123',
  };

  const headers = {
    'Content-Type': 'application/x-www-form-urlencoded',
  };

  // Realiza el POST al login
  let res = http.post('http://web/Login/index.php', payload, { headers });

  // Guarda el tiempo de respuesta
  tiempoRespuesta.add(res.timings.duration);

  // Valida que al menos haya respondido con 200 OK
  check(res, {
    'Estado 200': (r) => r.status === 200,
  });

  sleep(1);
}

export function handleSummary(data) {
  console.log('\n🤝 RESUMEN DE LA PRUEBA DE CONCURRENCIA');
  console.log('----------------------------------------------');
  console.log(`👥 Usuarios ingresando al login al mismo tiempo: ${options.vus}`);
  console.log(`🕒 Duración de ejecución: ${options.duration}`);
  console.log(`📦 Solicitudes de inicio de sesión: ${data.metrics.http_reqs.values.count}`);
  console.log(`⏱ Promedio de respuesta del login: ${Math.round(data.metrics.http_req_duration.values.avg)} ms`);
  console.log(`✔️ Éxito de las solicitudes (status 200): ${(1 - data.metrics.http_req_failed.values.rate) * 100}%`);
  console.log(`🔒 Evalúa cómo responde el formulario bajo alta simultaneidad.`);
  return {};
}
