import { Component, ViewEncapsulation, Input, ChangeDetectionStrategy } from '@angular/core'
import { TableConfig } from '@spryker/table';

@Component({
    selector: 'mp-merchant-reviews-merchant-portal',
    templateUrl: './merchant-reviews-merchant-portal.component.html',
    styleUrls: ['./merchant-reviews-merchant-portal.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})

export class MerchantReviewMerchantPortalComponent {
    @Input() tableConfig: TableConfig;
    @Input() tableId?: string;
}
