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

## Usage

Access the application by visiting http://localhost:8085/ in your web browser.