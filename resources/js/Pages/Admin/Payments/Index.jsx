import React from "react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { usePage } from "@inertiajs/react";
import DynamicDataTable from "@/components/DynamicDataTable";

export default function Payments() {
    const { payments } = usePage().props;

    // Flatten relational data
    const flattenedPayments = payments.map((p) => ({
        id: p.id,
        booking_id: p.booking_id,
        guest_name: p.booking?.guest?.name || "N/A",
        property_title: p.booking?.property?.title || "N/A",
        amount: p.amount,
        payment_method: p.payment_method,
        status: p.status,
        transaction_id: p.transaction_id || "N/A",
        currency: p.currency,
        created_at: p.created_at,
    }));

    const columns = flattenedPayments.length ? Object.keys(flattenedPayments[0]) : [];

    const columnLabels = {
        id: "ID",
        booking_id: "Booking ID",
        guest_name: "Guest Name",
        property_title: "Property",
        amount: "Amount",
        payment_method: "Payment Method",
        status: "Status",
        transaction_id: "Transaction ID",
        currency: "Currency",
        created_at: "Created At",
    };

    // Function to render status badge
    const renderStatus = (status) => {
        let bgColor, textColor;
        switch (status) {
            case "completed":
                bgColor = "bg-green-100";
                textColor = "text-green-800";
                break;
            case "pending":
                bgColor = "bg-yellow-100";
                textColor = "text-yellow-800";
                break;
            case "failed":
                bgColor = "bg-red-100";
                textColor = "text-red-800";
                break;
            case "requires_payment_method":
                bgColor = "bg-gray-100";
                textColor = "text-gray-800";
                break;
            default:
                bgColor = "bg-gray-100";
                textColor = "text-gray-800";
        }
        return (
            <span
                className={`px-2 py-1 rounded-full text-sm font-medium ${bgColor} ${textColor}`}
            >
                {status.replace("_", " ")}
            </span>
        );
    };

    // Wrap data to inject rendered status
    const displayData = flattenedPayments.map((row) => ({
        ...row,
        status: renderStatus(row.status),
    }));

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <div className="p-6">
                    <h1 className="text-2xl font-semibold mb-4">Payments</h1>
                    <p className="text-slate-600 mb-6">
                        Here you can manage all payments.
                    </p>

                    <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        <DynamicDataTable
                            data={displayData}
                            columns={columns}
                            columnLabels={columnLabels}
                            disableActions={true}
                        />
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
