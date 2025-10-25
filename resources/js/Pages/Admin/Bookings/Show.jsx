import React from "react";
import { usePage, router } from "@inertiajs/react";
import { SidebarProvider } from "@/components/ui/sidebar";
import { AppSidebar } from "@/components/app-sidebar";
import { SidebarInset } from "@/components/ui/sidebar";
import { SiteHeader } from "@/components/site-header";
import { Calendar, MapPin, User, Mail, Building2, Users } from "lucide-react";

export default function Show() {
    const { booking } = usePage().props;

    const statusColors = {
        pending: "bg-yellow-100 text-yellow-800 border-yellow-300",
        confirmed: "bg-green-100 text-green-800 border-green-300",
        cancelled: "bg-red-100 text-red-800 border-red-300",
    };

    const badgeColor = statusColors[booking.status] || "bg-gray-100 text-gray-800 border-gray-300";

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />

                <div className="min-h-screen bg-gradient-to-b from-slate-50 to-white p-8">
                    {/* Header */}
                    <div className="flex items-center justify-between mb-8">
                        <div>
                            <h1 className="text-3xl font-bold text-slate-800 tracking-tight">
                                Booking #{booking.id}
                            </h1>
                            <p className="text-slate-500 text-sm mt-1">
                                View detailed information about this booking
                            </p>
                        </div>

                        <div className="flex items-center gap-3">
                            <span
                                className={`px-3 py-1 rounded-full text-sm font-medium border ${badgeColor}`}
                            >
                                {booking.status}
                            </span>
                            <button
                                onClick={() => router.get(`/bookings/${booking.id}/edit`)}
                                className="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-all"
                            >
                                Edit
                            </button>
                            <button
                                onClick={() => router.get("/bookings")}
                                className="border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-100 transition-all"
                            >
                                ← Back
                            </button>
                        </div>
                    </div>

                    {/* Booking Info */}
                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {/* Guest Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <User size={18} />
                                <h2 className="font-semibold text-lg">Guest Information</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p className="flex items-center gap-2">
                                    <span className="font-medium w-24">Name:</span> 
                                    {booking.guest?.name || "N/A"}
                                </p>
                                <p className="flex items-center gap-2">
                                    <Mail size={16} className="text-slate-400" />
                                    {booking.guest?.email || "N/A"}
                                </p>
                            </div>
                        </div>

                        {/* Property Info */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <Building2 size={18} />
                                <h2 className="font-semibold text-lg">Property Details</h2>
                            </div>
                            <div className="space-y-2 text-slate-600">
                                <p><strong>Title:</strong> {booking.property?.title || "N/A"}</p>
                                <p className="flex items-center gap-2">
                                    <MapPin size={16} className="text-slate-400" />
                                    {booking.property?.address || "N/A"}
                                </p>
                                <p className="flex items-center gap-2">
                                    <Users size={16} className="text-slate-400" />
                                    <strong>Max Guests:</strong> {booking.property.max_guests || "N/A"}
                                </p>
                            </div>
                        </div>

                        {/* Booking Details */}
                        <div className="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all p-6 col-span-1 lg:col-span-2">
                            <div className="flex items-center gap-2 mb-4 text-slate-700">
                                <Calendar size={18} />
                                <h2 className="font-semibold text-lg">Booking Details</h2>
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-slate-600">
                                <p><strong>Check-in:</strong> {booking.check_in}</p>
                                <p><strong>Check-out:</strong> {booking.check_out}</p>
                                <p><strong>Total Price:</strong> {booking.total_price} MAD</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}
