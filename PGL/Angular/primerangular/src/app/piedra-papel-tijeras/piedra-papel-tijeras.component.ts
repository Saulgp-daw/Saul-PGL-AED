import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'piedra-papel-tijeras',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './piedra-papel-tijeras.component.html',
  styleUrl: './piedra-papel-tijeras.component.css'
})
export class PiedraPapelTijerasComponent {
  opciones = ["piedra", "tijeras", "papel"];
  eleccion: String = "";
  eleccionMaquina: string = "";
  resultado: string = "";
  finalizada: boolean = false;



  jugada() {
    let random = Math.floor(Math.random() * this.opciones.length);
    this.eleccionMaquina = this.opciones[random];
    console.log(this.eleccionMaquina);

    console.log(this.eleccion);

    if (this.eleccion == "piedra" && this.eleccionMaquina == "piedra") {
      this.resultado = "empate";
    } else if (this.eleccion == "piedra" && this.eleccionMaquina == "papel") {
      this.resultado = "maquina";
    } else if (this.eleccion == "piedra" && this.eleccionMaquina == "tijeras") {
      this.resultado = "usuario";
    } else if (this.eleccion == "papel" && this.eleccionMaquina == "piedra") {
      this.resultado = "maquina";
    } else if (this.eleccion == "papel" && this.eleccionMaquina == "papel") {
      this.resultado = "empate";
    } else if (this.eleccion == "papel" && this.eleccionMaquina == "tijeras") {
      this.resultado = "maquina";
    } else if (this.eleccion == "tijeras" && this.eleccionMaquina == "piedra") {
      this.resultado = "maquina";
    } else if (this.eleccion == "tijeras" && this.eleccionMaquina == "papel") {
      this.resultado = "usuario";
    } else if (this.eleccion == "tijeras" && this.eleccionMaquina == "tijeras") {
      this.resultado = "empate";
    }

    this.finalizada = true;



  }

  reseteo() {
    this.eleccion = "";
    this.eleccionMaquina = "";
    this.finalizada = false;
    this.resultado = "";
  }

}
