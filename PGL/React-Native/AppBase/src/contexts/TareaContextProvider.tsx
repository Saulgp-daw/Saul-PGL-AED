import React, { Dispatch, SetStateAction, useState, useContext, createContext } from 'react'
import { Tarea } from '../models/Tarea';

export interface TareasContextType {
    tareas: Tarea[];
    settareas: Dispatch<SetStateAction<Tarea[]>>;
}

//Contexto
const TareaContext = createContext<TareasContextType>({
    tareas: [],
    settareas: () => { }
});

//Proveedor

const TareaContextProvider = (props: any) => {
    const [misTareas, setMisTareas] = useState<Tarea[]>([]);
    const contextValues: TareasContextType = {
        tareas: misTareas,
        settareas: setMisTareas
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

