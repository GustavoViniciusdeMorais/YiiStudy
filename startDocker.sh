 #!/bin/bash
sudo docker container stop $(sudo docker container ls -aq)
sudo docker-compose up -d --build