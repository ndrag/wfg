A simple Laravel application to be deployed as part of a first test of AWS ECR, ECS, and CodeBuild.

[Following this guide](https://gbengaoni.com/blog/Deploy-a-Docker-ized-Laravel-Application-to-AWS-ECS-with-CodeBuild-4b0e388f4f53), but with modifications (e.g. PHP 8.1, not 7.3).

## Commands
Build the image (i.e. after making changes to the Dockerfile):
```
docker build -t works-for-good .
```
Serve it locally:
```
docker run -it -p 8001:80 works-for-good
```