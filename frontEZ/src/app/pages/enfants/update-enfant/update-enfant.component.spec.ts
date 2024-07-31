import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateEnfantComponent } from './update-enfant.component';

describe('UpdateEnfantComponent', () => {
  let component: UpdateEnfantComponent;
  let fixture: ComponentFixture<UpdateEnfantComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [UpdateEnfantComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UpdateEnfantComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
