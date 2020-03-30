# Search Pharmacies for Face Masks

Due to the outbreak of COVID-19, at 2020/2/15, Taiwan government requisitioned mask factories in Taiwan, and distributed masks with a high control to maintain the price of masks. Until now, each person can only purchase 3 masks per week.

This approach was effective, and the price of a mask is between 6 - 12 NT.

However, it also derives a new problem. Because each one can only buy 3 masks, people would line up to pharmacies to get those 3 masks.

So, this application is to help you find out which pharmacy ia available for masks.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

You need to have composer first

```
brew install composer
```

After having composer, install Laravel

```
composer global require laravel/installer
```

Last but not least, we need docker to build up our enviornment. Here is the official page of [docker](https://www.docker.com).

### Installing

To build up your enviornment, we need to add [Laradock](http://laradock.io) into our project: into our project folder and do


```
git clone https://github.com/Laradock/laradock.git
```

And then, into **laradock** folder, rename the `.env-example` to `.env`.

```
cp env-example .env
```

Lastly, run your container

```
docker-compose up -d nginx mysql redis workspace
```
Then you can see this application on http://127.0.0.1

## Built With

* [Laravel](http://laravel.com) - The web framework used
* [Swagger](http://swagger.io) - generate API documentation

## Authors

* **Harbor Liu** 

## Acknowledgments

* Especially thanks to **[kiang](https://github.com/kiang)** who provides API for face masks data.

