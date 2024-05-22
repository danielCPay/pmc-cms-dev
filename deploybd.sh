if docker ps >/dev/null 2>&1; then
    # Copy modules and languages from the first running container
    docker cp $(docker ps -q | sed -n '2p'):/var/lib/mysql/yetiforce /pmc/src
    
else
    echo "There are no running containers"
fi

