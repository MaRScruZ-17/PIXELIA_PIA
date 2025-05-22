const express = require('express');

const config = require('./server/config'); /*SE GUARDA EN UNA CONSTANTE LLAMADA CONFIG*/

require('./database'); /* SE CONECTA A LA BASE DE DATOS */

const app = config(express()); /* INICIA EL SERVIDOR */

app.listen(app.get('port'), () => {
    console.log('Server on port', app.get('port'));

}); 
express();