import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivitesMenuComponent } from './activites-menu.component';

describe('ActivitesMenuComponent', () => {
  let component: ActivitesMenuComponent;
  let fixture: ComponentFixture<ActivitesMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ActivitesMenuComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ActivitesMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
