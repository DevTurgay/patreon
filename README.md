# Test Patreon

This application has been developed exclusively for testing purposes. The project focuses on two primary functionalities: user authentication and content scheduling, which includes direct posting.

## Tech stack

The project is built using PHP, Laravel, MySQL, and Docker as its core technologies. For real-time notifications, we've integrated Pusher as a socket provider. The usage of Pusher is limited, and you can find the necessary credentials in the provided .env.example file.

## Requirements

To install and run this application on your local environment, you will need to have [Docker](https://docs.docker.com/get-docker/) installed.

Please note that the project runs on port :8085, and the database is proxied to :3001.

## Installation

Follow these steps to get started:

Clone the repository:

```bash
git clone https://github.com/DevTurgay/patreon.git
```

Copy .env.example file to .env

Run the application using Docker:

```bash
docker-compose up -d
```

Migrate the database

```bash
docker-compose exec patreon-fpm php artisan migrate
```

## Usage

Access the application by visiting http://localhost:8085/ in your web browser.

## Notes:

For this project, I utilized Laravel and PHP. To manage scheduled posts, a cron job was integrated into the Docker container. Additionally, content caching was implemented, and the cache is automatically purged whenever new content is published.

To provide real-time notifications, I leveraged Pusher.

It's important to note that I primarily focused on backend functionality and adhered to the time constraints specified in the task description. Consequently, there are several areas that could be improved.

For instance, in a more comprehensive implementation, I would consider implementing Kafka to handle the release of scheduled posts and user notifications. This choice would offer a more scalable and robust architecture. I did not address static data handling on the front-end, translations, or other frontend-related tasks. Given more time or in a real-life project, I would prioritize comprehensive request validations, which I did not fully explore in this project.

To simplify project setup, I intentionally kept the credentials in the env.example file, making it easy for you to build the project. Moreover, for improved scalability and resilience under high loads, Kubernetes and a load balancing solutions could be introduced.
