import React from "react";
import { usePage, router } from "@inertiajs/react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import {
    CreditCard,
    User,
    Home,
    DollarSign,
    Hash,
    ArrowLeft,
    Clock,
} from "lucide-react";

export default function Show() {
    const { payment } = usePage().props;

    // Map status → color scheme
    const statusColors = {
        completed: "bg-green-100 text-green-800 border-green-300",
        pending: "bg-yellow-100 text-yellow-800 border-yellow-300",
        failed: "bg-red-100 text-red-800 border-red-300",
        requires_payment_method: "bg-gray-100 text-gray-800 border-gray-300",
    };
    const badgeColor =
        statusColors[payment.status] || "bg-gray-100 text-gray-800 border-gray-300";

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />

                <div className="min-h-screen bg-gradient-to-b from-slate-50 to-white p-8">
                    {/* Header */}
                    <div className="flex justify-between items-center mb-8">
                        <div>
                            <h1 className="text-3xl font-bold text-slate-800 tracking-tight">
                                Payment #{payment.id}
                            </h1>
                            <p className="text-slate-500 text-sm mt-1">
                                Detailed information about this transaction
                            </p>
                        </div>

                        <div className="flex items-center gap-3">
                            <span
                                className={`px-3 py-1 rounded-full text-sm font-medium border ${badgeColor}`}
                            >
                                {payment.status.replace("_", " ")}
                            </span>
                            <button
                                onClick={() => router.get("/payments")}
                                className="flex items-center gap-2 border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-100 transition-all"
                            >
                                <ArrowLeft size={16} />
                                Back
                            </button>
                        </div>
                    </div>

                    {/* Content grid */}
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {/* Payment Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <CreditCard size={18} />
                                <h2 className="font-semibold text-lg">Payment Information</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p className="flex items-center gap-2">
                                    <DollarSign size={16} className="text-slate-400" />
                                    <strong>Amount:</strong> {payment.amount} {payment.currency.toUpperCase()}
                                </p>
                                <p>
                                    <strong>Method:</strong> {payment.payment_method}
                                </p>
                                <p>
                                    <strong>Transaction ID:</strong>{" "}
                                    {payment.transaction_id || "N/A"}
                                </p>
                                <p>
                                    <strong>Created At:</strong>{" "}
                                    <span className="flex items-center gap-1">
                                        <Clock size={15} className="text-slate-400" />
                                        {payment.created_at}
                                    </span>
                                </p>
                            </div>
                        </div>

                        {/* Booking Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <Hash size={18} />
                                <h2 className="font-semibold text-lg">Booking Details</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p><strong>Booking ID:</strong> {payment.booking?.id}</p>
                                <p><strong>Check-in:</strong> {payment.booking?.check_in}</p>
                                <p><strong>Check-out:</strong> {payment.booking?.check_out}</p>
                                <p>
                                    <strong>Total:</strong> {payment.booking?.total_price} USD
                                </p>
                            </div>
                        </div>

                        {/* Guest Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <User size={18} />
                                <h2 className="font-semibold text-lg">Guest Information</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p>
                                    <strong>Name:</strong> {payment.booking?.guest?.name || "N/A"}
                                </p>
                                <p>
                                    <strong>Email:</strong> {payment.booking?.guest?.email || "N/A"}
                                </p>
                            </div>
                        </div>

                        {/* Property Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <Home size={18} />
                                <h2 className="font-semibold text-lg">Property Details</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p>
                                    <strong>Title:</strong> {payment.booking?.property?.title || "N/A"}
                                </p>
                                <p>
                                    <strong>Address:</strong>{" "}
                                    {payment.booking?.property?.address || "N/A"}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
