import { Component } from '@angular/core';
import { RouterLink, RouterOutlet } from '@angular/router';
import { MostrarComponent } from './mostrar/mostrar.component';
import { CrearComponent } from './crear/crear.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, MostrarComponent, CrearComponent, RouterLink],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'peliculas';
}
