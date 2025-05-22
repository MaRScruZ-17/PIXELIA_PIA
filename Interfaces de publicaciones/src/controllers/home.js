//Controlador = Objeto con funciones para exportar
const ctrl = {};

const { Image } = require('../models');

ctrl.index = async (req, res) => {
    try {
        const images = await Image.find().sort({ timestamp: -1 });
        res.render('index', { images });
    } catch (error) {
        res.status(500).send('Error al cargar las imágenes');
    }
};

module.exports = ctrl;

ctrl.index = async (req, res) => {
    try {
        const images = await Image.find().sort({ timestamp: -1 });
        res.render('index', { images });
    } catch (error) {
        res.status(500).send('Error al cargar las imágenes');
    }
};