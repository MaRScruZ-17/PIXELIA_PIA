const path = require('path');
const exphbs = require('express-handlebars');

const morgan = require('morgan');
const multer = require('multer');
const express = require('express');

const routes = require('../routes/index'); //se importa el archivo de rutas
const errorHandler = require('errorhandler'); //se importa el archivo de errorhandler

module.exports = app => {  /*Se va a recibir una constante "app"*/
    
    //Settings
    //se va a crear una variable de entorno llamada PORT, si no existe se le asigna el vlor 3000
    app.set( 'port', process.env.PORT || 3000); 
    app.set('views', path.join(__dirname, '../views'));
    app.engine('.hbs', exphbs.engine({
        defaultLayout: 'main',
        partialsDir: path.join(app.get('views'), 'partials'), 
        layoutsDir: path.join(app.get('views'), 'layouts'),
        extname: '.hbs',
        helpers: require('./helpers')
    }));
    app.set('view engine', '.hbs');  


    //Middlewares
    app.use(morgan('dev'));
    app.use(multer({dest: path.join(__dirname, '../public/upload/temp')}).single('image')); //para subir archivos
    app.use(express.urlencoded({extended: false})); //IMAGENES - para recibir datos de formularios
    app.use(express.json()); //LIKES - para recibir datos en formato json

    //Routes
    routes(app);

    //Static files
    app.use(express.static(path.join(__dirname, '../public'))); //para servir archivos estaticos

    //Error handlers
    if ('development' === app.get('env')){
        app.use(errorHandler);
    }

return app;
}