const express = require('express');
const router = express.Router();

const home = require('../controllers/home');
const image = require('../controllers/image');

module.exports = (app) => {

    //Controladores que se encargaran de procesar las imagenes (guardarlas, dar like, comentarios)
    router.get('/', home.index); //Listar todas las imagenes
    router.get('/images/:image_id', image.index); //Listar una imagen en particular a traves de un ID
    router.post('/images', image.create); //Usuario pueda subir imagenes
    router.post('/images/:image_id/like', image.like); //Usuario pueda dar likes
    router.post('/images/:image_id/comment', image.comment); //Usuario pueda comentar
    router.delete('/images/:image_id', image.remove); //Usuario pueda eliminar una imagen en especifico

    app.use(router);

};
