import React, { Dispatch, SetStateAction, useState, useContext, createContext } from 'react'
import { Raza } from '../models/Raza';

interface RazaArray extends Array<Raza[]> {}

//interfaz
export interface RazaContextType {
    razas: RazaArray;
    setrazas: Dispatch<SetStateAction<RazaArray>>;
}

//Contexto

const defaultRazas: RazaArray = [
    [
        new Raza(1, 'perro', 'Beagle', '../resources/Perros/beagle.jpg'),
        new Raza(2, 'perro', 'Cocker Spaniel Americano', '../resources/Perros/cocker_spaniel_americano.jpg'),
        new Raza(3, 'perro', 'Dachshund', '../resources/Perros/dachshund.webp'),
        new Raza(4, 'perro', 'Labrador Retriever', '../resources/Perros/Labrador-retriever.jpg'),
        new Raza(5, 'perro', 'Pomeranian', '../resources/Perros/Pomeranian.webp'),
        new Raza(6, 'perro', 'Poodle', '../resources/Perros/poodle.jpg'),
        new Raza(7, 'perro', 'Shiba Inu', '../resources/Perros/shiba_inu.jpg'),
        new Raza(8, 'perro', 'Husky Siberiano', '../resources/Perros/siberian-husky.jpg')
    ],
    [
        new Raza(1, 'gato', 'Calico', 'calico.jpg'),
        new Raza(2, 'gato', 'Bangalí', 'bengali.jpg'),
        new Raza(3, 'gato', 'Bombay', 'bombay.jpg'),
        new Raza(4, 'gato', 'Angora', 'angora.jpg'),
        new Raza(5, 'gato', 'Manx', 'manx.jpg'),
        new Raza(6, 'gato', 'Noruega de los Bosques', 'noruega_de_los_bosques.webp'),
        new Raza(7, 'gato', 'Ragdoll', 'ragdoll.png'),
        new Raza(8, 'gato', 'Siamés', 'siames.png')
    ]
];

const RazaContext = createContext<RazaContextType>({
    razas: defaultRazas,
    setrazas: () => {}
});

//Proveedor
const RazaContextProvider = (props: any) => {
    const [misRazas, setMisRazas] = useState<RazaArray>(defaultRazas);
    const contextValues: RazaContextType = {
        razas: misRazas,
        setrazas: setMisRazas
    }

    return (
        <RazaContext.Provider value={contextValues}>
            {props.children}
        </RazaContext.Provider>
    )
}

export const useRazaContext = () => {
    return useContext(RazaContext);
}
export default RazaContextProvider;