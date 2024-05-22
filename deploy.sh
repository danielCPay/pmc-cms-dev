if docker ps >/dev/null 2>&1; then
    # Copy modules and languages from the first running container
    docker cp $(docker ps -q | head -n 1):/var/www/html/modules /pmc/src
    docker cp $(docker ps -q | head -n 1):/var/www/html/languages /pmc/src
    sudo docker cp $(docker ps -q | sed -n '2p'):/var/lib/mysql/yetiforce /pmc/src
    # Add, commit, and push changes in the /pmc/src directory
    cd /pmc/src || exit
    git add .
    git commit -m "Updated modules and languages [skip ci]"
    git push origin main
    cd - || exit

    # Stop and remove all running containers
    docker stop $(docker ps -q)
    docker rm $(docker ps -aq)
    docker rmi -f $(docker images -q)
    docker system prune -a --force
else
    echo "There are no running containers"
fi

