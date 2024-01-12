import React, { Dispatch, SetStateAction, useState, useContext } from 'react'
import { Pelicula } from '../models/Pelicula'
import { createContext } from 'react';
import PeliculasFavoritas from '../components/PeliculasFavoritas';



export interface PeliculasContextType {
  pelisfavoritas: Pelicula[];
  setpelisfavoritas: Dispatch<SetStateAction<Pelicula[]>>;
  token: string;
  settoken: Dispatch<SetStateAction<string>>;
};

//Contexto
const PeliculasContext = createContext<PeliculasContextType>({
  pelisfavoritas: [],
  setpelisfavoritas: () => { },
  token: '',
  settoken: () => { }
});


//Proveedor
const PeliculasContextProvider = (props: any) => {
  const [pelisFavoritas, setPelisFavoritas] = useState<Pelicula[]>([]);
  const [token, setToken] = useState<string>('');

  const contextValues: PeliculasContextType = {
    pelisfavoritas: pelisFavoritas,
    setpelisfavoritas: setPelisFavoritas,
    token: token,
    settoken: setToken
  }

  return (
    <PeliculasContext.Provider value={contextValues}>
      {props.children}
    </PeliculasContext.Provider>
  )
}
export const useAppContext = () => {
  return useContext(PeliculasContext);
}
export default PeliculasContextProvider