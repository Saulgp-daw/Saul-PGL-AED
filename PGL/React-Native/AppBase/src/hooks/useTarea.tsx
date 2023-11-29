import React from 'react'
import { useTareaContext } from '../contexts/TareaContextProvider';
import { Tarea } from '../models/Tarea';



const useTarea = () => {
    const { tareas, settareas } = useTareaContext();

    function toggleCompletado (tarea: Tarea): void {
        const nuevasTareas: Tarea[] = tareas.map(t =>
            t.getId() === tarea.getId() ? new Tarea(t.getId(), t.getTitulo(), t.getContenido(), !t.getCompletado()) : t
          );
        settareas(nuevasTareas);
    };

    function borrarTarea(id: number): void{
        const nuevasTareas: Tarea[] = tareas.filter(t => t.getId() !== id);
        settareas(nuevasTareas);
    }

    
  return { toggleCompletado, borrarTarea }
}

export default useTarea