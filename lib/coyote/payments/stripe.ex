defmodule Coyote.Payments.Stripe do
  use Ecto.Schema
  import Ecto.Changeset

  schema "payments" do
    field :subject, :string

    timestamps()
  end

  @doc false
  def changeset(stripe, attrs) do
    stripe
    |> cast(attrs, [:subject])
    |> validate_required([:subject])
  end
end
