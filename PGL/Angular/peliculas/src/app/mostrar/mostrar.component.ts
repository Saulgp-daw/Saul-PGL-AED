import { Component, OnInit } from '@angular/core';
import { ToDoService } from '../to-do.service';
import { ToDo } from '../Models/ToDo';
import { JsonPipe } from '@angular/common';

@Component({
  selector: 'app-mostrar',
  standalone: true,
  imports: [JsonPipe],
  templateUrl: './mostrar.component.html',
  styleUrl: './mostrar.component.css'
})
export class MostrarComponent implements OnInit {

  todos: ToDo[] = [];

  constructor(private servicio: ToDoService) { }

  ngOnInit(): void {
    this.todos = this.servicio.getAll();
  }

}
