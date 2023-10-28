import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {BandService} from "../../services/band.service";
import {Band} from "../../../interfaces/band";
import {Observable} from "rxjs";
import {MatDialog} from "@angular/material/dialog";
import {BandFormComponent} from "./band-form/band-form.component";

@Component({
  selector: 'app-band-table',
  templateUrl: './band-table.component.html',
  styleUrls: ['./band-table.component.scss']
})
export class BandTableComponent implements OnInit {

  @Output() changeBand = new EventEmitter<Band>();

  bandsDataSource: Observable<Band[]>

  displayedColumns = ['action-edit', 'action-delete', 'name', 'origin', 'city', 'startYear', 'endYear', 'foundingMembers', 'membersCount', 'trend', 'description'];

  public selectedBand?: Band;

  constructor(
    private bandService: BandService,
    public dialog: MatDialog
  ) {
    this.bandsDataSource = bandService.bands
  }

  ngOnInit(): void {
    this.bandService.getAllBands();
  }

  openEditDialog(band: Band) {
    this.dialog.open(BandFormComponent, {
      data: band,
      height: '60%',
      width: '60%'
    });
  }

  openDeleteDialog(band: Band) {
    this.bandService.deleteBand(band);
  }
}
