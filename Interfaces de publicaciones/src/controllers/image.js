const path = require('path'); // Obtiene la extensión del archivo que se sube
const { randomNumber } = require('../helpers/libs');
const fs = require('fs-extra'); // Permite trabajar con el sistema de archivos

const { Image } = require('../models'); // Importa el modelo de la imagen

const ctrl = {};


ctrl.index = async (req, res) => {
    // Busca la imagen por coincidencia parcial en el filename
    const image = await Image.findOne({ filename: { $regex: req.params.image_id, $options: 'i' } });
    console.log(image);
    res.render('image', {image});

};

ctrl.create = (req, res) => {
    if (!req.file) {
        return res.status(400).json({ error: 'No se subió ningún archivo o el archivo es demasiado grande.' });
    }

    const saveImage = async () => {
    const imgUrl = randomNumber(); //Genera un nombre aleatorio para la imagen
    const images = await Image.find({ filename: imgUrl}); //Validación, por si ya existe una imagen con el mismo nombre
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
            filename: imgUrl + ext, //Nombre de la imagen con la extensión 
            description: req.body.description
        });
        const imageSaved = await newImg.save(); //Guarda la imagen en la base de datos
        res.redirect('/images/' + imgUrl); 

    } else { 
        await fs.unlink(imageTempPath); //Elimina la imagen temporal
        res.status(500).json({ error: 'Solo imagenes permitidas' }); //Devuelve un error si la extensión no es válida
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