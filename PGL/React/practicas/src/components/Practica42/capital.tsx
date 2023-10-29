import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';

type Props = {}

interface interfazCapitales{
    name: string; 
    code: string; 
   datos: Array<number>;
}

const Capital = (props: Props) => {
    const { id }= useParams();
    const [datos, setDatos] = useState<interfazCapitales>({} as interfazCapitales);
    let ruta = " https://servicios.ine.es/wstempus/js/es/DATOS_TABLA/2911?tip=AM";

    useEffect(() => {
        async function getData(direccion: string) {
            const response = await axios.get(direccion+id);
            console.log(response);
        

            const newData: interfazCapitales = {
                name: response.data[Number(id)].Nombre,
                code: response.data[Number(id)].COD,
                datos: response.data[Number(id)].Data
            }
            setDatos(newData);
        }
        getData(ruta);
    }, [id])

  return (
    <div>
        <h3>Datos Provincia</h3>
        <p>{JSON.stringify(datos)}</p>
    </div>
  )
}

export default Capital