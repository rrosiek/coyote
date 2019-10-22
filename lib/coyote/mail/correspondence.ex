defmodule Coyote.Mail.Correspondence do
  use Ecto.Schema
  import Ecto.Changeset

  schema "correspondence" do
    field :subject, :string

    timestamps()
  end

  @doc false
  def changeset(correspondence, attrs) do
    correspondence
    |> cast(attrs, [:subject])
    |> validate_required([:subject])
  end
end
