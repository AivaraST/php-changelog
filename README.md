# Vanilla PHP project (changelogs)
This project was created for fun, you can check live version on [aiv.lt](https://aiv.lt/changelogs) website.

### Installation
Clone code from github  
`git clone https://github.com/AivaraST/php-changelog.git`

Install PHP dependencies (you need composer for that)  
`composer install`

Install node_modules (you need node for npm)   
`npm install`

Build project assets  
`npm run build`

Copy .env.example config and put your database information in .env    
`cp .env.example .env`

Insert dummy db tables into your database  
`test/db-example.txt`

### Dev
Start live assets compiler via gulp  
`npm run dev`

### App stack
- HTML
- CSS (SCSS)
- JS
- GULP
- PHP (OOP)

### Maybe TODO in the future
- [ ] Add twig template engine.
- [ ] Add forms validation, because now there is no validation.
