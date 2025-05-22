const path = require('path'); // Obtiene la extensión del archivo que se sube
const { randomNumber } = require('../helpers/libs');
const fs = require('fs-extra'); // Permite trabajar con el sistema de archivos

const { Image } = require('../models'); // Importa el modelo de la imagen

const ctrl = {};


ctrl.index = (req, res) => {

};

ctrl.create = (req, res) => {

    const saveImage = async () => {
    const imgUrl = randomNumber(); //Genera un nombre aleatorio para la imagen
    const images = await Image.find({ filename: imgUrl }); //Validación, por si ya existe una imagen con el mismo nombre
    if (images.length > 0) { //Si existe una imagen con el mismo nombre, genera otro nombre
        saveImage();
    } else {
    console.log(imgUrl); //Muestra el nombre aleatorio en la consola
    const imageTempPath = req.file.path;
    const ext = path.extname(req.file.originalname).toLowerCase(); //Convierte la extensión a minúsculas
    const targetPath = path.resolve(`src/public/upload/${imgUrl}${ext}`) //Ruta donde se guardará la imagen
    
    if (ext === '.png' || ext === '.jpg' || ext === '.jpeg' || ext === '.gif') { //Verifica que la extensión sea una de las permitidas
        await fs.rename(imageTempPath, targetPath); //Renombra la imagen
        const newImg = new Image ({ //Crea una nueva imagen para almacenar en la base de datos
            title: req.body.title,
            description: req.body.description,
            filename: `${imgUrl}${ext}`
        });
        const imageSaved = await newImg.save(); //Guarda la imagen en la base de datos
        //res.redirect('/images/:image_id'); //Redirige a la página de imágenes
        res.send('works');
    } else { 
        await fs.unlink(imageTempPath); //Elimina la imagen temporal
        res.status(500).json({ error: 'Solo imagenes permitidas' }); //Devuelve un error si la extensión no es válida
        return; 

    }
    }
    };    

    saveImage();
};

ctrl.like = (req, res) => {

};

ctrl.comment = (req, res) => {

};

ctrl.remove = (req, res) => {

};

module.exports = ctrl;