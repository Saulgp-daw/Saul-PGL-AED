import React, { Dispatch, SetStateAction, useState, useContext, createContext } from 'react'
import { Tarea } from '../models/Tarea';

export interface TareasContextType {
    tareas: Tarea[];
    setTareas: Dispatch<SetStateAction<Tarea[]>>;
}

//Contexto
const TareaContext = createContext<TareasContextType>({
    tareas: [],
    setTareas: () => { }
});

//Proveedor

const TareaContextProvider = (props: any) => {
    const [misTareas, setMisTareas] = useState<Tarea[]>([]);
    const contextValues: TareasContextType = {
        tareas: misTareas,
        setTareas: setMisTareas
    }

    return (
        <TareaContext.Provider value={contextValues}>
            {props.children}
        </TareaContext.Provider>
    )
}

export const useTareaContext = () => {
    return useContext(TareaContext);
}

export default TareaContextProvider;

