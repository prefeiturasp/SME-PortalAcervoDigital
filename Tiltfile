docker_compose('docker-compose.yml')
docker_build('wordpress/acervo', '.',
  live_update = [
    sync('.', '/var/www/html')
  ])