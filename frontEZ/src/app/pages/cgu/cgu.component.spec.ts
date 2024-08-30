import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CgvComponent } from './cgu.component';

describe('CgvComponent', () => {
  let component: CgvComponent;
  let fixture: ComponentFixture<CgvComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CgvComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CgvComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
