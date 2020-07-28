echo '# build images && run docker-compose'
docker-compose -f docker-compose.yml up -d

echo 'list docker container'
docker-compose ps
