import { Injectable } from '@angular/core';
import { ToDo } from './Models/ToDo';

@Injectable({
  providedIn: 'root'
})


export class ToDoService {

  constructor() {
    this.todos.push(new ToDo(1, "primeratarea"));
    this.todos.push(new ToDo(2, "segundatarea"));
  }
  todos: Array<ToDo> = [];

  getAll() {
    return this.todos;
  }

  add(toDo: ToDo): void {
    this.todos.push(toDo);
  }
}
