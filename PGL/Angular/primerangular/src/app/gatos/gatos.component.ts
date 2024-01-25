import { Component } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-gatos',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './gatos.component.html',
  styleUrl: './gatos.component.css'
})
export class GatosComponent {
  edadHumana: number = 0;

  gatoFormData = new FormGroup({
    nombre: new FormControl(""),
    peso: new FormControl(""),
    edad: new FormControl(""),

  });

  comprobarEdad() {
    let edad = Number(this.gatoFormData.value.edad);

    switch (edad) {
      case 1:
        this.edadHumana = 1;
        break;
      case 2:
      case 3:
        this.edadHumana = 3;
        break;
      case 4:
        this.edadHumana = 7;
        break;
      case 5:
        this.edadHumana = 8;
        break;
      case 6:
        this.edadHumana = 10;
        break;
    }

  }
}

class Gato {
  constructor(nombre = "", edad = 0, peso = 0, equivalencia = 0) {

  }
}


