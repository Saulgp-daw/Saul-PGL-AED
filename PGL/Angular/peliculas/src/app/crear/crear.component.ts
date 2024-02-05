import { CommonModule, JsonPipe } from '@angular/common';
import { Component, Inject, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { ToDoService } from '../to-do.service';
import { ToDo } from '../Models/ToDo';

@Component({
  selector: 'app-crear',
  standalone: true,
  imports: [CommonModule,
    ReactiveFormsModule, JsonPipe],
  templateUrl: './crear.component.html',
  styleUrl: './crear.component.css'
})
export class CrearComponent {

  todoService: ToDoService = inject(ToDoService);


  lista = this.todoService.getAll();

  form = new FormGroup({
    id: new FormControl(''),
    nombre: new FormControl(''),
    terminado: new FormControl('')
  });

  public guardar() {
    let id = this.form.value.id ?? "";
    let nombre = this.form.value.nombre ?? "";
    let terminado = this.form.value.terminado ?? false;


    let newToDo = new ToDo(parseInt(id), nombre, !!terminado);
    console.log(newToDo);

    this.lista.push(newToDo);



  }


}
