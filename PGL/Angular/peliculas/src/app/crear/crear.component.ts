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


  prueba = this.todoService.getAll();

  form = new FormGroup({
    id: new FormControl(''),
    nombre: new FormControl(''),
    terminado: new FormControl('')
  });

  public guardar() {

  }


}
