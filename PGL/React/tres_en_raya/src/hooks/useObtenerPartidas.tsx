import React from 'react'
import { Partida } from '../models/Partida'
import {useState} from 'react';
import axios from 'axios';
import {useEffect} from 'react';

type Props = {}

export interface iPartida {
    id: number,
    J1: string, 
    J2: string,
    tablero: string[][],
    ganador: string
}

export interface iPartidas {
    partidas: Array<Partida>
}

const useObtenerPartidas = () => {
    const ruta = "http://localhost:3000/partidas/";
    const [arrayPartidas, setArrayPartidas] = useState<iPartidas>({partidas: []});

    useEffect(() => {
        async function recogerDatosPartidas(){
            try{
                const response = await axios.get<iPartida[]>(ruta);
                const partidasGuardadas: iPartidas = {
                    partidas: response.data.map( (partidaData: iPartida) => {
                        return new Partida (
                            partidaData.id, 
                            partidaData.J1, 
                            partidaData.J2,
                            partidaData.tablero, 
                            partidaData.ganador
                        );
                    })
                }
                setArrayPartidas(partidasGuardadas);
                console.log(partidasGuardadas);
                
            }catch(error){
                console.error('Error al obtener datos de la API', error);    
            }
        }
        recogerDatosPartidas();
    }, []);
    
  return { arrayPartidas, setArrayPartidas, ruta }
}

export default useObtenerPartidas