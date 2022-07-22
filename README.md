Source Code that I found online:
https://www.section.io/engineering-education/dockerized-php-apache-and-mysql-container-development-environment/
https://github.com/krepysh-spec/lamp-docker-php-skeleton


1. Open a command prompt in this directory.
2. Run "server.sh start". This command will
    -  build images
    -  run all containers
    -  Create a table "june-table" and insert 2 rows sample data.

  other commands you can use:
    - "server.sh stop_containers" to stop all running containers
    - "server.sh restart_containersstop_containers" to restart all running containers


    website url is http://127.0.0.1:80

    Database connection details:
      username: june
      password: 5678
      port: 9906

    you can use phpmysqladmin to access database using this url: http://127.0.0.1:8080/

    redis connection: http://127.0.0.1:8081/

3. After finishing work, run "python stopContainers.py" to bring down all containers.


OpenQuestions:
  Question1:
  1.1). Firstly, I will deploy a VPC with 3 subnets(public, private and data) and across 3/4 AZs, and it will be 9 to 12 subnets.
    2). A internet Gateway that attach to this VPC, which allow access to internet from Public subnets.
    3). 3/4 NAT Gateways that locate in each Public subnets(e.g Public-subnet-az1, Public-subnet-az2, Public-subnet-az3)
    4). Then one public route tables that associated with all public subnets. And route tables for each private and data subnets.
    5). Network ACLs control traffic to each subnet.
    6). Maybe site-to-site VPN and Transit Gateway that connect VPC with on-premise network.

    The security consider here is that Public subnet is internet facing. Traffic can come in through Internet Gateway. 
    Public subnets can talk to Private Subnets.
    Traffic can come in to Private Subnets through Internet Gateway and then NAT Gateway.
    Private Subnets can access Data subnets
    Network ACL will deny traffic from Public Subnets to Data Subnets.

  2.Deploy An Aurora MySQL (would be good to try serverless Aurora) cluster with read and write instance, deploy accross 3/4 AZs. 
    Aurora is cheaper and better performace than normalRDS.
  3.Deploy EC2 instance(s) associate with Autoscaling Group that give it auto healing and aslo can be scaling with Cloudwatch Alarm associated. deploy across 3/4 AZs.
  4.Deploy An Application Load Balancer to Public subents accross 3/4 AZs. which will forward traffic from port80, and port 443 to the Instances that we deployed in step 3.
    For Port 80, redirect to port 443.
  5.Request a certificate from aws certificate Manager to attach to port 443 listner, the beauty of certificate manager is that AWS look after the certificat renew.

  6.Configure the Security Group of Database that only allow traffic from the EC2 Intances the we deployed in Step3.
    Security Group of the ALB deployed in Step 4 that will be open to public.
    Security Group of the EC2 instances will accept traffic from ALB and go to Database.
  
  7.Monitoring:
    1.) VPC flow to trace traffic.
    2.) Cloudwatch for application logs and metrics.
    3.) Can also use some third party tools like Sumologic and Nagios.

  8. Deploy Public URL use Route 53 (Domain name and records).

  Question2:
    Install Docker desktop in this windows 10 machine.


    

