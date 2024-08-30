import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DevoirMenuComponent } from './devoir-menu.component';

describe('DevoirMenuComponent', () => {
  let component: DevoirMenuComponent;
  let fixture: ComponentFixture<DevoirMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DevoirMenuComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DevoirMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
