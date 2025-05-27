//Controlador = Objeto con funciones para exportar
const ctrl = {};

const { Image } = require('../models');

ctrl.index = async (req, res) => {
    const imagesRaw = await Image.find().sort({timestamp: -1});
    const images = imagesRaw.map(img => img.toObject({ virtuals: true }));
    res.render('index', { images });
};

module.exports = ctrl;