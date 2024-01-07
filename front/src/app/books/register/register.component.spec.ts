import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BooksRegisterComponent } from './register.component';

describe('CadastroComponent', () => {
  let component: BooksRegisterComponent;
  let fixture: ComponentFixture<BooksRegisterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [BooksRegisterComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(BooksRegisterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
