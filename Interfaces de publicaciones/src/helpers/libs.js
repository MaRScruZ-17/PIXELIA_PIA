//FUNCIONES PARA UTILIZAR EN EL PROYECTO
const helpers = {};

//Objeto vacio que nos servira para generar un nombre aleatorio para las imagenes
helpers.randomNumber = () => {
    const possible = 'abcdefghijlkmnopqrstuvwxyz0123456789';
        //Let = Variable
        let randomNumber = '';
        for (let i = 0; i < 6; i++) { //Genera un nombre aleatorio de 6 caracteres
        //Math.floor se encarga de redondear el numero hacia abajo (5.32 -> 5)
        randomNumber += possible.charAt(Math.floor(Math.random() * possible.length)); //Genera un numero aleatorio entre 0 y la longitud del string
    }
return randomNumber; //Retorna el nombre aleatorio    
};

module.exports = helpers; //Exporta el objeto helpers para poder usarlo en otros archivos