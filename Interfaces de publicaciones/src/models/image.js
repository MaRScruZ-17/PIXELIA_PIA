//INFORMACIÓN RELACIONADA A LAS IMÁGENES
const mongoose = require('mongoose');
const { Schema } = mongoose;
const path = require('path');

const ImageSchema = new Schema ({
    title: { type: String },
    description: { type: String },  
    filename: { type: String },
    views: { type: Number, default: 0 },
    likes: { type: Number, default: 0 },
    timestamp: { type: Date, default: Date.now }
});

ImageSchema.set('toObject', { virtuals: true });
ImageSchema.set('toJSON', { virtuals: true });

//Este uniqueID le quita la extensión al nombre del archivo, solo devuelve el nombre
ImageSchema.virtual('uniqueId')
    .get(function() {
        return this.filename.replace(path.extname(this.filename), '')
});

module.exports = mongoose.model('Image', ImageSchema);