import { Component, ViewEncapsulation, Input, ChangeDetectionStrategy } from '@angular/core';
import { TableConfig } from '@spryker/table';

@Component({
    selector: 'mp-merchant-review-merchant-portal',
    templateUrl: './merchant-review-merchant-portal.component.html',
    styleUrls: ['./merchant-review-merchant-portal.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class MerchantReviewMerchantPortalComponent {
    @Input() tableConfig: TableConfig;
    @Input() tableId?: string;
}
