import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'primerangular';
  resultadoTabla = "";
  numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

  unMetodo(num = 1) {
    let strTabla = "";
    for (let i = 1; i <= 10; i++) {
      strTabla += num + " x " + i + " = " + i * num + " \n";

    }
    this.resultadoTabla = strTabla;
  }


}
