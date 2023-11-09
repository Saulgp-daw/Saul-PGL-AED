import axios from 'axios';
import React, { useEffect, useState } from 'react'
import CapitalCard from './CapitalCard';

type Props = {}

interface iCapitales {
    capitales: Array<Capital>
}

type Capital = {
    id: string;
    nombre: string;
    foto: string;
    datos: Array<Datos>;
}

type Datos = {
    anio: number;
    poblacion: number;

}

const CapitalesList = (props: Props) => {
    const [capitalesData, setCapitalesData] = useState<iCapitales>({ capitales: [] });
    const uri: string = "http://localhost:3000/capitales/";

    useEffect(() => {
        async function recogerDatosCapitales(direccion: string) {
            const response = await axios.get(direccion);
            console.log(response.data);

            const newCapitales: iCapitales = {
                capitales: response.data


            }
            setCapitalesData(newCapitales);
        }
        recogerDatosCapitales(uri);
    }, []);


    // console.log(capitalesData);




    return (
        <div>
            <h3>Capitales</h3>
            {capitalesData.capitales ? (
            capitalesData.capitales.map(capital => (
                <div key={capital.id}>
                    <CapitalCard capital={capital} />
                </div>
            ))
        ) : (
            <p>Cargando datos...</p>
        )}

        </div>
    )
}

export default CapitalesList