import { Component } from '@angular/core';
import { WeatherService } from '../weather.service';
import { HttpClient } from '@angular/common/http';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'app-weather',
  templateUrl: './show.component.html',
  styleUrl: './show.component.css'
})
export class ShowWeatherComponent {
  public weather:any = {};
  public condition:any = null;
  public moon:any = null;
  constructor(private weatherService: WeatherService, private http: HttpClient, private sanitizer: DomSanitizer) {}
  
  ngOnInit() {
    this.weatherService.checkWeather().subscribe(data => {
      if (data) {
        this.weather = data.results;
        this.condition = `/assets/conditions/${this.weather.condition_slug}.svg`;
        this.moon = `https://assets.hgbrasil.com/weather/icons/moon/${this.weather.moon_phase}.png`;
      }
    });
  }
}
