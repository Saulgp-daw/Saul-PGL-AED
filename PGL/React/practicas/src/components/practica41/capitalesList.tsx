import axios from 'axios';
import React, { useEffect, useState } from 'react'

type Props = {}

interface iCapitales {
    capitales: Array<Object>
}

const CapitalesList = (props: Props) => {
    const [capitalesData, setCapitalesData] = useState<iCapitales>({} as iCapitales);
    const uri: string = "http://localhost:3000/capitales/";
    
    useEffect(() => {
        async function recogerDatosCapitales(direccion: string){
            const response = await axios.get(direccion);
            // console.log(response.data);
            
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

    </div>
  )
}

export default CapitalesList