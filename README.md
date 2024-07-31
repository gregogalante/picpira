# Picpira

PHP + React reserved area boilerplate.

## Deploy to production

- Modify the config.php file with your credentials

- Install npm dependencies with `npm install`

- Start the build with `npm run build`

- Clone the repository on your server and copy the files to the desired folder

## Run locally PHP

- Build the docker image with `docker build -t picpira .`

- Run the docker container with `docker run -p 80:80 -v $(pwd):/var/www/html picpira`

## Run locally React

- Install npm dependencies with `npm install`

- Start the development server with `npm start`
