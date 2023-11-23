import React, { createContext, Dispatch, SetStateAction, useContext, useState } from 'react';
import { Partida } from '../models/Partida';

export interface PartidaContextType {
    partida: Partida;
    setpartida: Dispatch<SetStateAction<Partida>>;
}

//Contexto
const PartidaContext = createContext<PartidaContextType>({
    partida: {} as Partida,
    setpartida: () => {}
});

//Proveedor
const PartidaContextProvider = (props: any) => {
    const [miPartida, setMiPartida] = useState<Partida>(new Partida(0, "", "", [[]]));

    const contextValues: PartidaContextType = {
        partida: miPartida,
        setpartida: setMiPartida,
    };

    return (
        <PartidaContext.Provider value={contextValues}>
            {props.children}
        </PartidaContext.Provider>
    );
};
export const usePartidaContext = () => {
    return useContext(PartidaContext);
}

export default PartidaContextProvider;
